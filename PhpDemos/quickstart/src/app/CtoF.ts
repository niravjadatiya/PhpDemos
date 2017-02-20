import { Component } from '@angular/core';

@Component({
  selector: 'CtoF',
  template: `
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <label class="btn btn-primary">Celsius</label>
    <input class="form-group" type="text" [(ngModel)] = "CelsiusValue" (keyup)=CF()>
    <label class="btn btn-primary">Fahrenheit</label>
    <input class="form-group" type="text" [(ngModel)] = "FahrenheitValue" (keyup)=FC()>
  `
})
export class CtoF {
  CelsiusValue = 1;
  FahrenheitValue = 0;

  CF() {
    if (this.CelsiusValue) {
      this.FahrenheitValue = this.CelsiusValue * 9 / 5 + 32;
    }
    else {
      this.CelsiusValue = 1;
    }
  }

  FC() {
    if (this.FahrenheitValue) {

      this.CelsiusValue = (this.FahrenheitValue - 32) * 5 / 9;
    }
    else {
      // this.FahrenheitValue = 0;
    }
  }
  ngOnInit() {
    this.CF();
  }
}
