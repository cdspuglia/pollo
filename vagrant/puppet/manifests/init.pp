exec { 'apt-get update':
  user => root,
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

include java, git, nginx, php, eventstore, elasticsearch
