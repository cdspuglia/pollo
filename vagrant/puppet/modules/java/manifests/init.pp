class java {
  package { ['default-jre']:
    ensure => present,
    require => Exec['apt-get update'],
  }
}