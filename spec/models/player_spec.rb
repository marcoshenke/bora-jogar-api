require 'rails_helper'

RSpec.describe Player, type: :model do
    describe "Validations" do
        it { should validate_presence_of(:full_name) }
        it { should validate_presence_of(:city) }
    end

    describe "Relationships" do
        it { should belong_to(:user) }
        it { should have_one(:profile) }
        it { should have_many(:availabilities) }
    end
end
