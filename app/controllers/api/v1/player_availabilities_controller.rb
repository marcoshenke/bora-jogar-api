module Api
  module V1
    class PlayerAvailabilitiesController < ApplicationController
      before_action :authenticate_user!
      before_action :load_player

      def index
        availabilities = @player.availabilities.includes(:week_day)
        render_success(availabilities.map { |a| PlayerAvailabilitySerializer.new(a) })
      end

      def create
        availability = @player.availabilities.build(availability_params)

        if availability.save
          render_success(PlayerAvailabilitySerializer.new(availability), 'Availability created successfully', :created)
        else
          render_error(availability.errors.full_messages.join(', '))
        end
      end

      def destroy
        availability = @player.availabilities.find_by(id: params[:id])

        if availability&.destroy
          render_success(nil, 'Availability deleted successfully')
        else
          render_error('Availability not found', :not_found)
        end
      end

      private

      def load_player
        @player = current_user.player
        return render_error('Player not found', :not_found) unless @player
      end

      def availability_params
        params.require(:availability).permit(:week_day_id, :start_time, :end_time)
      end
    end
  end
end