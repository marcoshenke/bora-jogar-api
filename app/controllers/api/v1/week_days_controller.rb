module Api
  module V1
    class WeekDaysController < ApplicationController
      def index
        week_days = WeekDay.all
        render_success(week_days.map { |d| { id: d.id, name: d.name } })
      end
    end
  end
end