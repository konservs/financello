# Financello
The web-based financial and project management application

## Requirements
You need the following components before installation:
 1. Composer
 2. MySQL server with empty database

## Optional components
The next components are not required, but you could have them for a better performance or additional features:
 1. **Memcached.** Memcached is not required, but Financello supports caching and Memcached will speed up the application perfomance and you will need less powerfull server.
 2. **SMTP server.** SMTP server required for sending notifications, daily/weekly/monthly reports, etc.

## Installation
Currenly I had not developed installation script and you need to perform 4 simple easy steps.

**Step 1.** Let's clone the latest code from the reposithory
```{r, engine='bash', code_block_name}
git clone https://github.com/konservs/financello.git ./
git submodule update --recursive --remote
```

**Step 2.** Install required frameworks using composer
```{r, engine='bash', code_block_name}
composer install
```

**Step 3.** Create database and edit the configuration file.
Configuration file is available at **config/config.php** path.
```{r, engine='bash', code_block_name}
vendor/bin/phinx migrate
vendor/bin/phinx seed:run
```


## Updating the code
```{r, engine='bash', code_block_name}
git submodule update --recursive --remote
composer update
vendor/bin/phinx migrate
```
