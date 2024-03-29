# config valid for current version and patch releases of Capistrano
lock "~> 3.16"

set :application, "firestone_locator"
set :repo_url, "https://github.com/pulibrary/firestone_locator.git"

# Default branch is :main
set :branch, ENV["BRANCH"] || "main"

# Default deploy_to directory is /var/www/my_app_name
set :deploy_to, "/var/www/firestone_locator_cap"

set :tmp_dir, '/home/deploy/tmp'

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# append :linked_files, "config/database.yml"

# Default value for linked_dirs is []
# append :linked_dirs, "log", "tmp/pids", "tmp/cache", "tmp/sockets", "public/system"
append :linked_dirs, "sql-files"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
# set :keep_releases, 5

# Uncomment the following to require manually verifying the host key before first deploy.
# set :ssh_options, verify_host_key: :secure


desc "copy the db config"
task :copy_db_config do
  on roles(:app) do |host|
    execute "cp /home/deploy/db_config.php #{release_path}/includes"
    info "copied db_config.php"
  end
end
after :deploy, :copy_db_config

desc "link the images directories"
task :link_images do
  on roles(:app) do |host|
    execute "mkdir #{release_path}/images/stage"
    execute "cd #{release_path}/images/production && ln -sf #{fetch(:locator_fileshare_mount)}/production f"
    execute "cd #{release_path}/images/stage && ln -sf #{fetch(:locator_fileshare_mount)}/stage f"
    info "linked the images directories"
  end
end
after :deploy, :link_images

desc "Run mysql client against a local sql file SQL_DIR/SQL_GZ_FILE"
task :import_dump do
  gz_file_name = ENV["SQL_GZ_FILE"]
  sql_file_name = gz_file_name.sub('.gz','')
  sql_dir = ENV['SQL_DIR']
  on roles(:app) do |host|
    upload! File.join(sql_dir, gz_file_name), "/tmp/#{gz_file_name}"
    execute "gzip -d -f /tmp/#{gz_file_name}"
    execute "mysql #{fetch(:stage_db)}< /tmp/#{sql_file_name}"
    execute "mysql #{fetch(:production_db)}< /tmp/#{sql_file_name}"
  end
end

desc "Upload images for the floor plans to the server FILE_DIR/GZ_FILE"
task :upload_images do
  gz_file_name = ENV["GZ_FILE"]
  file_name = gz_file_name.sub('.gz','')
  file_dir = ENV['FILE_DIR']
  on roles(:app) do |host|
    upload! File.join(file_dir, gz_file_name), "/tmp/#{gz_file_name}"
    execute "gzip -d -f /tmp/#{gz_file_name}"
    execute :mkdir, '-p', "#{release_path}/images/production/f"
    execute :mkdir, '-p', "#{release_path}/images/stage/f"
    execute "cd #{release_path}/images/production/f && tar -xvf /tmp/#{file_name}"
    execute "cd #{release_path}/images/stage/f && tar -xvf /tmp/#{file_name}"
  end
end

desc "Update the database engine to be INNODB"
task :update_engine do
  alter_sql = [
              "alter table lctr_Campus_cn ENGINE= InnoDB;",
              "update lctr_Collections_cn set date_cn = '2013-01-01 01:01:01'  WHERE CAST(date_cn AS CHAR(20)) = '0000-00-00 00:00:00';",
              "alter table lctr_Collections_cn ENGINE= InnoDB;",
              "alter table lctr_Coordinates_cn ENGINE= InnoDB;",
              "alter table lctr_External_cn ENGINE= InnoDB;",
              "alter table lctr_Messages_cn ENGINE= InnoDB;",
              "alter table lctr_Octavos_cn ENGINE= InnoDB;",
              "alter table lctr_Octavos_cn_orig ENGINE= InnoDB;",
              "alter table lctr_Oversize_cn ENGINE= InnoDB;",
              "alter table lctr_User_usr ENGINE= InnoDB;"
              ]
  on roles(:app) do |host|
    alter_sql.each do |sql_statement|
      execute "mysql #{fetch(:stage_db)} -e \"#{sql_statement}\""
      execute "mysql #{fetch(:production_db)} -e \"#{sql_statement}\""
    end
  end
end
