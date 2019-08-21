set :branch, ENV["BRANCH"] || "master"


server "locator-staging1.princeton.edu", user: "deploy", roles: %w{app}

