set :branch, ENV["BRANCH"] || "master"


server "locator-prod1.princeton.edu", user: "deploy", roles: %w{app}

