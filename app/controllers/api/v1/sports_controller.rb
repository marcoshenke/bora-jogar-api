module Api
  module V1
    class SportsController < ApplicationController
      def index
        sports = Sport.all
        render_success(sports.map { |s| { id: s.id, name: s.name } })
      end

      def show
        sport = Sport.find_by(id: params[:id])
        if sport
          positions = sport.positions.map { |p| { id: p.id, name: p.name } }
          render_success({ id: sport.id, name: sport.name, positions: positions })
        else
          render_error('Sport not found', :not_found)
        end
      end
    end
  end
end