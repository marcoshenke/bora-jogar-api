class CreateWeekDays < ActiveRecord::Migration[7.1]
  def change
    create_table :week_days do |t|
      t.string :name, null: false

      t.timestamps
    end
  end
end