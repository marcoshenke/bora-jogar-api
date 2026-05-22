source "https://rubygems.org"
git_source(:github) { |repo| "https://github.com/#{repo}.git" }

ruby "3.3.11"

gem "rails", "~> 7.1.0"
gem "pg", "~> 1.5"
gem "puma", "~> 6.0"
gem "redis", "~> 5.0"
gem "bootsnap", require: false

gem "devise", "~> 4.9"
gem "devise-jwt", "~> 0.12.0"
gem "jwt", "~> 2.7"
gem "rack-cors", "~> 2.0"

gem "active_model_serializers", "~> 0.10"
gem "tzinfo-data", platforms: [:windows, :jruby]

group :development, :test do
  gem "debug", platforms: [:mri, :windows]
  gem 'rspec-rails'
  gem 'factory_bot_rails'
  gem 'faker'
  gem 'shoulda-matchers'
end

group :development do
  gem "web-console"
  gem "rubocop", require: false
  gem "rubocop-rails", require: false
end
