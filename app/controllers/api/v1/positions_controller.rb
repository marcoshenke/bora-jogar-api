module Api
  module V1
    class PositionsController < ApplicationController
      def index
        positions = Position.all
        render_success(positions.map { |p| { id: p.id, name: p.name, sport_id: p.sport_id } })
      end

      def show
        position = Position.find_by(id: params[:id])
        if position
          render_success({ id: position.id, name: position.name, sport_id: position.sport_id })
        else
          render_error('Position not found', :not_found)
        end
      end
    end
  end
end