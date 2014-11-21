class eventstore {
  exec { 'setup-eventstore':
    user    => 'vagrant',
    group   => 'vagrant',
    creates => '/home/vagrant/.eventstore_installed',
    cwd     => '/home/vagrant',
    command => "wget http://download.geteventstore.com/binaries/EventStore-OSS-Linux-v3.0.1.tar.gz -O EventStore.tar.gz && tar xf EventStore.tar.gz && cd EventStore* && ./clusternode --mem-db &",
    path    => ['/bin', '/usr/bin'];
  }

  file { 'mark-eventstore-installed':
    owner   => 'vagrant',
    path    => '/home/vagrant/.eventstore_installed',
    content => '',
    require => Exec['setup-eventstore'];
  }
}