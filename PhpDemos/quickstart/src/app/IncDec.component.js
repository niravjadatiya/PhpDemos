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
var IncDecComponent = (function () {
    function IncDecComponent() {
        this.incdecarray = [];
        this.newTryArray = [];
        this.counter = 0;
    }
    IncDecComponent.prototype.clicked = function (obj, objindec) {
        if (obj == '-') {
            objindec.val -= 1;
        }
        else if (obj == '+') {
            objindec.val += 1;
        }
        console.log("obj= " + obj + " objindec= " + objindec + " objindec.val= " + objindec.val);
        // (console.log(obj));
    };
    IncDecComponent.prototype.addDiv = function () {
        //console.log(this.incdec);
        var objIncdec = {
            val: 5
        };
        this.incdecarray.push(objIncdec);
    };
    IncDecComponent.prototype.newClicked = function (newObj, myObj) {
        if (newObj == '-') {
            myObj.val -= 1;
        }
        else if (newObj == '+') {
            myObj.val += 1;
        }
        // (console.log(obj));
    };
    IncDecComponent.prototype.newTryDiv = function () {
        console.log("test");
        var myObj = {
            val: 0
        };
        this.newTryArray.push(myObj);
    };
    IncDecComponent = __decorate([
        core_1.Component({
            selector: 'IncDec',
            template: "\n\n    <button (click)=\"newTryDiv()\">New</button>\n    <button (click) =\"addDiv()\">Add</button>\n\n    <div class='mainDiv' *ngFor=\"let objindec of incdecarray\">\n        <button (click)=\"clicked('-', objindec)\" class='btns'>-</button>\n        <input type='text' value={{objindec.val}}  class='textBox'>\n        <button (click)=\"clicked('+', objindec)\" class='btns'>+</button>\n    </div>\n\n    <div class='mainDiv' *ngFor =\"let myObj of newTryArray\">\n        <button (click)=\"clicked('+', myObj)\" class='btns'>+</button>\n        <input type='text' value={{myObj.val}} class='textBox'>\n        <button (click)=\"clicked('-', myObj)\" class='btns'>-</button>\n    </div>\n\n  ",
            styleUrls: ['app/app.component.css']
        }), 
        __metadata('design:paramtypes', [])
    ], IncDecComponent);
    return IncDecComponent;
}());
exports.IncDecComponent = IncDecComponent;
//# sourceMappingURL=IncDec.component.js.map