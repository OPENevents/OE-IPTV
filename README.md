# Not maintained, this project has reached its end of life. #

## OE-IPTV ##

Web interface for MuMuDVB 

### Installation  ###

#### Récupérer les sources du projet ####

> cd /var/www

> git clone https://github.com/OPENevents/OE-IPTV.git

> cd OE-IPTV

#### Configuration ####

##### Configuration de l'application #####

> vi system/application/config/config.php

- Editer la valeur de $config['base_url'] avec l'url de votre serveur

> vi system/application/config/database.php

- Configurer les paramètres d'accès à votre base de données MySQL

##### Création de la base de données MySQL #####

###### Structure ######

    CREATE TABLE `chaine` (
      `id` int(11) NOT NULL auto_increment,
      `name` varchar(50) NOT NULL,
      `ip_multicast` varchar(15) NOT NULL,
      `num_service` int(11) NOT NULL,
      `pid` varchar(50) NOT NULL,
      `tuner_id` int(11) NOT NULL,
      `is_active` tinyint(4) NOT NULL default '1',
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

    CREATE TABLE `config` (
          `id` int(11) NOT NULL auto_increment,
      `name` varchar(100) NOT NULL,
      `value` text,
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

    CREATE TABLE `tuner` (
      `id` int(11) NOT NULL auto_increment,
      `name` varchar(50) NOT NULL,
      `num_card` tinyint(4) NOT NULL,
      `frequence_transponder` varchar(10) NOT NULL,
      `polarite` varchar(50) default NULL,
      `srate` int(11) default NULL,
      `modulation` varchar(20) default NULL,
      `coderate` varchar(10) NOT NULL default 'auto',
      `dvb_s2` tinyint(1) default NULL,
      `dvr` tinyint(1) default NULL,
      `is_active` tinyint(4) NOT NULL default '0',
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

###### Données ######

    INSERT INTO `config` (`id`, `name`, `value`) VALUES
    (1, 'common_port', '1234'),
    (2, 'sap', '1'),
    (3, 'sap_default_group', 'MYGROUP'),
    (4, 'rewrite_pat', '1'),
    (5, 'ip_http', '127.0.0.1'),
    (6, 'port_http', '4200');

##### Script de lancement : mumudvb #####

Déplacer le script permettant de contrôler les instances MumuDVB

> mv mumudvb.sh /etc/init.d/mumudvb

> chmod +x /etc/init.d/mumudvb

Modifier le fichier /etc/sudoers pour donner les permissions à www-data

> visudo

Ajouter la ligne :

> www-data   ALL=NOPASSWD: /etc/init.d/mumudvb
