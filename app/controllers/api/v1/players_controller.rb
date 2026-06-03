module Api
  module V1
    class PlayersController < ApplicationController
      before_action :check_authentication, only: [:create, :update]

      def create
        if current_user.player.present?
          return render_error('User already has a player profile')
        end

        player = current_user.build_player(player_params)

        if player.save
          render_success(PlayerSerializer.new(player), 'Player created successfully', :created)
        else
          render_error(player.errors.full_messages.join(', '))
        end
      end

      def show
        player = current_user.player

        if player
          render_success(PlayerSerializer.new(player))
        else
          render_error('Player not found', :not_found)
        end
      end

      def update
        player = current_user.player

        if player&.update(player_params)
          render_success(PlayerSerializer.new(player), 'Player updated successfully')
        else
          render_error(player&.errors&.full_messages&.join(', ') || 'Player not found', :not_found)
        end
      end

      private

      def check_authentication
        return render_error('Unauthorized', :unauthorized) if current_user.nil?
      end

      def player_params
        params.require(:player).permit(:full_name, :city, :avatar, :bio)
      end
    end
  end
end