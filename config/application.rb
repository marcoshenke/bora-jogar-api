require_relative "boot"

require "rails"
require "active_model/railtie"
require "active_job/railtie"
require "active_record/railtie"
require "action_controller/railtie"
require "action_view/railtie"

Bundler.require(*Rails.groups)

module BoraJogarApi
  class Application < Rails::Application
    config.load_defaults 7.1
    config.api_only = true

    config.session_store :cookie_store, key: '_bora_jogar_session'
    config.middleware.use ActionDispatch::Cookies
    config.middleware.use config.session_store, config.session_options

    config.autoload_lib(ignore: %w[assets tasks])

    config.middleware.insert_before 0, Rack::Cors do
      allow do
        origins '*'
        resource '*', headers: :any, methods: [:get, :post, :put, :patch, :delete, :options, :head], expose: ['Authorization']
      end
    end
  end
end