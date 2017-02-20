"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
var router_1 = require('@angular/router');
var theMovieDbComponent = (function () {
    function theMovieDbComponent(http, router) {
        this.http = http;
        this.router = router;
        this.genre_name = '';
        this.imgLink = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2/';
        this.pageNo = 1;
    }
    theMovieDbComponent.prototype.ngOnInit = function () {
        var _this = this;
        // this.loadData();
        this.http.get('http://api.themoviedb.org/3/movie/popular?api_key=5de339ee88941d862165471adf9d5473&page=1')
            .subscribe(function (data) {
            // console.log(data.json().results);
            _this.movieArray = data.json().results;
            // console.log(this.movieArray);
        });
    };
    theMovieDbComponent.prototype.getGenreIds = function (genre) {
        this.genre_ids = [
            { "id": 28,
                "name": "Action"
            },
            {
                "id": 12,
                "name": "Adventure"
            },
            {
                "id": 16,
                "name": "Animation"
            },
            {
                "id": 35,
                "name": "Comedy"
            },
            {
                "id": 80,
                "name": "Crime"
            },
            {
                "id": 99,
                "name": "Documentary"
            },
            {
                "id": 18,
                "name": "Drama"
            },
            {
                "id": 10751,
                "name": "Family"
            },
            {
                "id": 14,
                "name": "Fantasy"
            },
            {
                "id": 36,
                "name": "History"
            },
            {
                "id": 27,
                "name": "Horror"
            },
            {
                "id": 10402,
                "name": "Music"
            },
            {
                "id": 9648,
                "name": "Mystery"
            },
            {
                "id": 10749,
                "name": "Romance"
            },
            {
                "id": 878,
                "name": "Science Fiction"
            },
            {
                "id": 10770,
                "name": "TV Movie"
            },
            {
                "id": 53,
                "name": "Thriller"
            },
            {
                "id": 10752,
                "name": "War"
            },
            {
                "id": 37,
                "name": "Western"
            }
        ];
        // if(genre = this.genre_ids)  {
        //     genre = genre
        // }
        var i, j, category;
        category = '';
        for (i = 0; i < genre.length; i++) {
            for (j = 0; j < this.genre_ids.length; j++) {
                if (genre[i] == this.genre_ids[j].id) {
                    // console.log(this.genre_ids[j].name + this.genre_ids[j].id);
                    category += this.genre_ids[j].name + " ";
                }
            }
        }
        // console.log("-----------------------");
        return category;
    };
    theMovieDbComponent.prototype.loadMore = function () {
        var _this = this;
        this.pageNo++;
        this.http.get('http://api.themoviedb.org/3/movie/popular?api_key=5de339ee88941d862165471adf9d5473&page=' + this.pageNo)
            .subscribe(function (data) {
            // console.log(data.json().results);
            var i;
            for (i = 0; i < data.json().results.length; i++) {
                _this.movieArray.push(data.json().results[i]);
            }
            // console.log(data.json().results.length);
        });
    };
    theMovieDbComponent.prototype.detailedView = function (mov) {
        console.log(mov.id);
        var link = ['/MoreInfo', mov.id];
        this.router.navigate(link);
        console.log(link);
    };
    theMovieDbComponent = __decorate([
        core_1.Component({
            selector: 'TheMovieDb',
            templateUrl: 'app/theMovieDb.component.html',
            styleUrls: ['app/theMovieDbComponent.css']
        }), 
        __metadata('design:paramtypes', [http_1.Http, router_1.Router])
    ], theMovieDbComponent);
    return theMovieDbComponent;
}());
exports.theMovieDbComponent = theMovieDbComponent;
var GenreIds = (function () {
    function GenreIds() {
    }
    return GenreIds;
}());
var Movie = (function () {
    function Movie() {
    }
    return Movie;
}());
//# sourceMappingURL=theMovieDb.component.js.map