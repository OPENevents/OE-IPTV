#!/bin/sh

# mumudvb.sh
# http://github.com/OPENevents
# Guillaume Marsay <support@openevents.fr>
# 2011-04-29

PIDDIR=/var/run/mumudvb
CONFDIR=/etc/mumudvb
DAEMON=/usr/bin/mumudvb
DAEMONUSER=_mumudvb

case "$1" in
	start)
		if [ $2 ]; then
			echo "Launching $DAEMON with $2..."
			if [ ! -f $CONFDIR/$2.conf ]; then
				echo "Config file $CONFDIR/$2.conf not found."
			elif [ -f $PIDDIR/$2.pid ]; then
				echo "This daemon is already running."
			else
				/sbin/start-stop-daemon --start --oknodo --make-pidfile --pidfile $PIDDIR/$2.pid --exec $DAEMON -- -c $CONFDIR/$2.conf
				PIDTEMP=$(cat $PIDDIR/$2.pid)
				echo $(expr $PIDTEMP + 1) > $PIDDIR/$2.pid
			fi
		elif [ ! $2 ]; then
			echo "Launching $DAEMON..."
			for FILE in $(ls $CONFDIR/ | grep .conf); do
				echo "$FILE"
				if [ -f $CONFDIR/$FILE ]; then
					if [ -f $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid ]; then
						echo "This daemon is already running."
					else
						start-stop-daemon --start --make-pidfile --pidfile $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid --exec $DAEMON -- -c $CONFDIR/$(basename $FILE | cut -f 1 -d '.').conf
						PIDTEMP=$(cat $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid)
						echo expr $PIDTEMP + 1 > $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid
						sleep 2
					fi
				fi
			done
		fi
		;;
	stop)
		if [ $2 ]; then
			echo "Stopping $DAEMON with $2..."
			if [ ! -f $CONFDIR/$2.conf ]; then
				echo "Config file $CONFDIR/$2.conf not found."
			elif [ ! -f $PIDDIR/$2.pid ]; then
				echo "This daemon is already stopped."
			else
				start-stop-daemon --stop --oknodo --pidfile $PIDDIR/$2.pid --exec $DAEMON
				rm $PIDDIR/$2.pid
			fi
		elif [ ! $2 ]; then
			echo "Stopping $DAEMON..."
			for FILE in $(ls $CONFDIR/ | grep .conf); do
				if [ -f $CONFDIR/$FILE ]; then
					if [ ! -f $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid ]; then
						echo "This daemon is already stopped."
					else
						echo "$FILE"
						start-stop-daemon --stop --oknodo --pidfile $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid --exec $DAEMON
						rm $PIDDIR/$(basename $FILE | cut -f 1 -d '.').pid
						sleep 2
					fi
				fi
			done
		fi
		;;
	status)
		if [ $2 ]; then
			ps aux | grep -v grep | grep "mumudvb -c $CONFDIR/$2" | awk '$11=="/usr/bin/mumudvb" {print 1}'
		fi
		;;
esac
exit 0
