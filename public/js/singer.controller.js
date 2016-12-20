var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.Singer = function () {
        this.getSinger(SINGER_ID);
    }

    Controller.Singer.prototype.getSinger = function(id) {
        var self = this;
        $.ajax({
            url: '/api/singer/index/'+id,
            success: function(data) {
                console.log(data);
                self.setStageName(data.stage_name);
                self.setName(data.name || 'Chưa rõ');
                self.setBirthday(data.birthday || 'Chưa rõ');
                self.setNation(data.nation.name);
                self.setDescription(data.description);
            },
            error: function(data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

    Controller.Singer.prototype.setStageName = function(name) {
        this.stageName = name;
        $('#stage-name').html(name);
    }

    Controller.Singer.prototype.setName = function(name) {
        this.name = name;
        $('#name').html(name);
    }

    Controller.Singer.prototype.setBirthday = function(birthday) {
        this.birthday = birthday;
        $('#birthday').html(birthday);
    }

    Controller.Singer.prototype.setNation = function(nation) {
        this.nation = nation;
        $('#nation').html(nation);
    }

    Controller.Singer.prototype.setDescription = function(description) {
        this.description = description;
        $('#description').html(description);
    }

})(DaMusic.Controller)