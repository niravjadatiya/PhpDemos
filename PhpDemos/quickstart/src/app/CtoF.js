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
var CtoF = (function () {
    function CtoF() {
        this.CelsiusValue = 1;
        this.FahrenheitValue = 0;
    }
    CtoF.prototype.CF = function () {
        if (this.CelsiusValue) {
            this.FahrenheitValue = this.CelsiusValue * 9 / 5 + 32;
        }
        else {
            this.CelsiusValue = 1;
        }
    };
    CtoF.prototype.FC = function () {
        if (this.FahrenheitValue) {
            this.CelsiusValue = (this.FahrenheitValue - 32) * 5 / 9;
        }
        else {
        }
    };
    CtoF.prototype.ngOnInit = function () {
        this.CF();
    };
    CtoF = __decorate([
        core_1.Component({
            selector: 'CtoF',
            template: "\n  <link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7\" crossorigin=\"anonymous\">\n    <label class=\"btn btn-primary\">Celsius</label>\n    <input class=\"form-group\" type=\"text\" [(ngModel)] = \"CelsiusValue\" (keyup)=CF()>\n    <label class=\"btn btn-primary\">Fahrenheit</label>\n    <input class=\"form-group\" type=\"text\" [(ngModel)] = \"FahrenheitValue\" (keyup)=FC()>\n  "
        }), 
        __metadata('design:paramtypes', [])
    ], CtoF);
    return CtoF;
}());
exports.CtoF = CtoF;
//# sourceMappingURL=CtoF.js.map