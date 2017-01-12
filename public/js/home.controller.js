var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.Home = function () {
        this.loadAudioOld();
        this.initBanner();
        this.getTopOfMonth();
        this.loadTopOfMonthByNation(2,'vietnam-top');
        this.loadTopOfMonthByNation(3,'korea-top');
        this.loadTopOfMonthByNation(4,'us-top');
    }

    Controller.Home.prototype.loadAudioOld = function () {
        var self = this;
        $.ajax({
            url: '/api/audio/random?limit=4',
            dataType: 'json',
            success: function (data) {
                self.setAudioOld(data);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.Home.prototype.setAudioOld = function (data) {
        let self = this;
        let divContainer = $('#old-container');
        data.forEach(e => {
            let divHint = self.initDivOld(e.code, e.singers[0].image, e.name, e.singers);
            divContainer.append(divHint);
        });
    }

    Controller.Home.prototype.initDivOld = function (code, img, name, singers) {
        let imgLink = img ? img.name : "/api/image/index/124794cb4fbbca1a578d2d474998096a";
        let link = '/play-audio/' + code;
        let divHint = $('<div class="audio-hint-element"></div>');
        let aTag = $('<a href="' + link + '" class=""></a>');
        let divImg = $('<div class="image-fill-container image"></div>');
        let image = $('<img class="wide w3-hover-shadow" src="' + imgLink + '" />');
        let divName = $('<div class="hint-name"></div>');
        let hName = $('<div>' + name + '</div>');
        let divSingers = $('<div class="hint-singers"></div>');
        divSingers.append('<a href="/singer/' + singers[0].id + '">' + singers[0].stage_name + '</a>');
        for (let i = 1, len = singers.length; i < len; i++) {
            divSingers.append('<a href="/singer/' + singers[i].id + '">, ' + singers[i].stage_name + '</a>');
        }
        divName.append(hName);
        divName.append(divSingers);
        divImg.append(image);
        aTag.append(divImg);
        aTag.append(divName);
        divHint.append(aTag);

        return divHint;
    }

    Controller.Home.prototype.initBanner = function () {
        var self = this;
        $.ajax({
            url: '/api/banner/get',
            success: function (data) {
                if(data.length == 0) return;
                let div = $(`
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    </div>
                `);
                self.divBannerIndicators = $('<ol class="carousel-indicators"></ol>');
                div.append(self.divBannerIndicators);
                self.divBannerInner = $('<div class="carousel-inner" role="listbox"></div>');
                div.append(self.divBannerInner);
                div.append(`
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                `);
                for (let i = 0, len = data.length; i < len; i++) {
                    let dt = data[i];
                    self.addBanner(i,dt.audio.code,dt.audio.name,dt.audio.singers,dt.image.name);
                }
                $('#my-banner').append(div);
                $('#myCarousel').carousel();
            },
            error: function (data) {
                console.log('error on load banner');
                console.log(data);
            }
        });
    }

    Controller.Home.prototype.addBanner = function(id,code,name,singers,imageLink) {
        var self = this;
        let active = id==0?'active':'';
        self.divBannerIndicators.append('<li data-target="#myCarousel" data-slide-to="'+id+'" class="'+active+'"></li>');
        let singersText =  singers[0].stage_name;
        for (let i = 1, len = singers.length; i < len; i++) {
            singersText += ', ' + singers[i].stage_name;
        }
        let href = '/play-audio/' + code;
        self.divBannerInner.append(`
            <div class="item `+active+`">
                <div class="image-fill-container" style="width:100%;height:300px;">
                    <img src="`+ imageLink +`" alt="`+name+`">
                </div>
                <div class="carousel-caption">
                    <h3><a href="`+href+`">`+name+`</a></h3>
                    <p>`+singersText+`</p>
                </div>
            </div>
        `);
    }

    Controller.Home.prototype.getTopOfMonth = function() {
        var self = this;
        $.ajax({
            url: '/api/audio/month_top',
            dataType: 'json',
            success: function (data) {
                self.setTopOfMonth(data);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.Home.prototype.setTopOfMonth = function (data) {
        let self = this;
        let divContainer = $('#top-of-month');
        data.forEach(e => {
            let divHint = self.initDivOld(e.code, e.singers[0].image, e.name, e.singers);
            divContainer.append(divHint);
        });
    }

    Controller.Home.prototype.loadTopOfMonthByNation = function (nationId,divId) {
        var self = this;
        $.ajax({
            url: '/api/audio/month_top/nation/'+nationId,
            dataType: 'json',
            success: function (data) {
                self.setTopOfMonthByNation(data,divId);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.Home.prototype.setTopOfMonthByNation = function (data,divId) {
        let self = this;
        let divContainer = $('#'+divId);
        data.forEach(e => {
            let divHint = self.initDivTopOfMonthByNation(e.code, e.singers[0].image, e.name, e.singers);
            divContainer.append(divHint);
        });
    }

    Controller.Home.prototype.initDivTopOfMonthByNation = function (code, img, name, singers) {
        let imgLink = img ? img.name : "/api/image/index/124794cb4fbbca1a578d2d474998096a";
        let link = '/play-audio/' + code;
        let divHint = $('<div class="audio-top-element"></div>');
        let aTag = $('<a href="' + link + '" class=""></a>');
        let divImg = $('<div class="image-fill-container image"></div>');
        let image = $('<img class="wide w3-hover-shadow" src="' + imgLink + '" />');
        let divName = $('<div class="top-name"></div>');
        let hName = $('<div>' + name + '</div>');
        let divSingers = $('<div class="top-singers"></div>');
        divSingers.append('<a href="/singer/' + singers[0].id + '">' + singers[0].stage_name + '</a>');
        for (let i = 1, len = singers.length; i < len; i++) {
            divSingers.append('<a href="/singer/' + singers[i].id + '">, ' + singers[i].stage_name + '</a>');
        }
        divName.append(hName);
        divName.append(divSingers);
        divImg.append(image);
        aTag.append(divImg);
        aTag.append(divName);
        divHint.append(aTag);

        return divHint;
    }

})(DaMusic.Controller)