require 'rails_helper'

RSpec.describe Position, type: :model do
    describe "Validations" do
        it { should validate_presence_of(:sport) }
        it { should validate_presence_of(:name) }
    end

    describe "Relationships" do
        it { should belong_to(:sport) }
        it { should have_and_belong_to_many(:player_profiles) }
    end
end
