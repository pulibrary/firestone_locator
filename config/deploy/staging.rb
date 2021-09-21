
server "locator-staging1.princeton.edu", user: "deploy", roles: %w{app}

set :stage_db, "locator_staging_stage"
set :production_db, "locator_staging_production"

set :locator_fileshare_mount, "/mnt/diglibdata/locator-data/staging_data"
