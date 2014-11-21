class php {

# Install php5 packages
  package { ['php5-fpm', 'php5-cli', 'php5-curl']:
    ensure => present,
    require => Exec['apt-get update'],
  }

# Make sure php5-fpm is running
  service { 'php5-fpm':
    ensure => running,
    require => Package['php5-fpm'],
  }

# Install composer globally
  exec { 'install-composer':
    creates => '/usr/bin/composer',
    cwd     => '/tmp',
    user    => root,
    path    => ['/usr/bin', '/bin'],
    command => 'wget http://getcomposer.org/composer.phar && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer',
    require => Package['php5-cli'],
  }
}