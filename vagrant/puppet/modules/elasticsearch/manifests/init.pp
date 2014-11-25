class elasticsearch {
  exec { 'download-elasticsearch-key':
    creates => '/home/vagrant/.elasticsearch_installed',
    user    => 'root',
    command => "wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | apt-key add -",
    path    => ['/bin', '/usr/bin'],
    require => Package['default-jre'];
  }

  exec { 'add-elasticsearch-repository':
    creates => '/home/vagrant/.elasticsearch_installed',
    user    => 'root',
    command => "echo 'deb http://packages.elasticsearch.org/elasticsearch/1.4/debian stable main' >> /etc/apt/sources.list",
    path    => ['/bin', '/usr/bin'],
    require => Exec['download-elasticsearch-key'];
  }

  exec { 'install-elasticsearch':
    creates => '/home/vagrant/.elasticsearch_installed',
    user    => 'root',
    command => "apt-get update && apt-get install -y elasticsearch",
    path    => ['/bin', '/usr/bin', '/usr/local/bin', '/sbin', '/usr/sbin'],
    require => Exec['add-elasticsearch-repository'];
  }

  exec { 'start-elasticsearch':
    creates => '/home/vagrant/.elasticsearch_installed',
    user    => 'root',
    command => "update-rc.d elasticsearch defaults 95 10 && /etc/init.d/elasticsearch start &",
    path    => ['/bin', '/usr/bin', '/usr/local/bin', '/usr/sbin'],
    require => Exec['install-elasticsearch'];
  }

  file { 'mark-elasticsearch-installed':
    owner   => 'vagrant',
    path    => '/home/vagrant/.elasticsearch_installed',
    content => '',
    require => Exec['start-elasticsearch'];
  }
}