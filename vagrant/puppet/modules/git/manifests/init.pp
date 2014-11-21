class git {

# Install git package
  package { ['git']:
    ensure => present,
    require => Exec['apt-get update'],
  }

}