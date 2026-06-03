Rails.application.routes.draw do
  namespace :api do
    namespace :v1 do
      devise_for :users, controllers: {
        sessions: 'api/v1/users/sessions',
        registrations: 'api/v1/users/registrations',
        passwords: 'api/v1/users/passwords'
      }

      resources :players, only: [:show] do
        resource :profile, only: [:show, :update]
        resources :availabilities, only: [:index, :create, :destroy]
      end

      post 'players', to: 'players#create'
      put 'players/:id', to: 'players#update'

      resources :sports, only: [:index, :show]
      resources :positions, only: [:index, :show]
      resources :week_days, only: [:index]
    end
  end

  get "up" => "rails/health#show", as: :rails_health_check
end