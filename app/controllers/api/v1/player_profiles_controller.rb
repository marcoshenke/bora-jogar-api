module Api
  module V1
    class PlayerProfilesController < ApplicationController
      before_action :authenticate_user!
      before_action :load_player

      def show
        profile = @player.profile

        if profile
          render_success(PlayerProfileSerializer.new(profile))
        else
          render_error('Profile not found', :not_found)
        end
      end

      def update
        profile = @player.profile

        if profile.nil?
          profile = @player.build_profile(profile_params)
        end

        if profile.update(profile_params)
          render_success(PlayerProfileSerializer.new(profile), 'Profile updated successfully')
        else
          render_error(profile.errors.full_messages.join(', '))
        end
      end

      private

      def load_player
        @player = current_user.player
        return render_error('Player not found', :not_found) unless @player
      end

      def profile_params
        params.require(:profile).permit(
          :favorite_position,
          :dominant_foot,
          :playing_style,
          :skill_level,
          :playing_frequency,
          position_ids: []
        )
      end
    end
  end
end