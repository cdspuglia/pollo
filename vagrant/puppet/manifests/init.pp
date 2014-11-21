exec { 'apt-get update':
  path => '/usr/bin',
}

file { '/pollo/':
  ensure => 'directory',
}

file { '/etc/hosts':
  ensure => present,
}

exec { 'add-pollo-host':
  unless => "grep pollo /etc/hosts",
  user => root,
  command => 'echo "127.0.0.1 pollo.local" >> /etc/hosts',
  path => ['/bin'];
}

include git, nginx, php, eventstore
