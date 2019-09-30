set :branch, ENV["BRANCH"] || "master"


server "locator-prod1.princeton.edu", user: "deploy", roles: %w{app}

set :stage_db, "locator_production_stage"
set :production_db, "locator_production_production"
