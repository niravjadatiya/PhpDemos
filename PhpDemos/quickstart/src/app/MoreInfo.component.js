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
var router_1 = require('@angular/router');
var http_1 = require('@angular/http');
var MoreInfo = (function () {
    function MoreInfo(route, http) {
        this.route = route;
        this.http = http;
        this.photo = 'http://image.tmdb.org/t/p/original';
    }
    MoreInfo.prototype.ngOnInit = function () {
        var _this = this;
        this.sub = this.route.params.subscribe(function (params) {
            _this.id = +params['id']; // (+) converts string 'id' to a number
            // In a real app: dispatch action to load the details here.     
        });
        this.link = "http://api.themoviedb.org/3/movie/" + this.id + "?api_key=5de339ee88941d862165471adf9d5473&append_to_response=credits,releases,images";
        this.http.get(this.link)
            .subscribe(function (data) {
            _this.moviesInfo = [data.json()];
        });
    };
    MoreInfo.prototype.ngOnDestroy = function () {
        this.sub.unsubscribe();
    };
    MoreInfo = __decorate([
        core_1.Component({
            selector: 'MoreInfo',
            templateUrl: 'app/MoreInfo.component.html',
            styleUrls: ['app/MoreInfo.component.css']
        }), 
        __metadata('design:paramtypes', [router_1.ActivatedRoute, http_1.Http])
    ], MoreInfo);
    return MoreInfo;
}());
exports.MoreInfo = MoreInfo;
var MovieIn = (function () {
    function MovieIn() {
    }
    return MovieIn;
}());
//# sourceMappingURL=MoreInfo.component.js.map