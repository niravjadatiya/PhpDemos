import { Component } from '@angular/core';
import { IncDec,newTry } from './IncDecDivArray';


@Component({
	selector: 'IncDec',
	template: `

    <button (click)="newTryDiv()">New</button>
    <button (click) ="addDiv()">Add</button>

    <div class='mainDiv' *ngFor="let objindec of incdecarray">
        <button (click)="clicked('-', objindec)" class='btns'>-</button>
        <input type='text' value={{objindec.val}}  class='textBox'>
        <button (click)="clicked('+', objindec)" class='btns'>+</button>
    </div>

    <div class='mainDiv' *ngFor ="let myObj of newTryArray">
        <button (click)="clicked('+', myObj)" class='btns'>+</button>
        <input type='text' value={{myObj.val}} class='textBox'>
        <button (click)="clicked('-', myObj)" class='btns'>-</button>
    </div>

  `,
	styleUrls: ['app/app.component.css']
})
export class IncDecComponent {
	incdecarray: IncDec[] = [];
    newTryArray: newTry[] = [];
	counter = 0;
    constructor() {
    }
	clicked(obj: any, objindec: IncDec) {
		if (obj == '-') {
			objindec.val -= 1;
		} else if (obj == '+') {
			objindec.val += 1;
		}
        console.log("obj= " + obj + " objindec= " + objindec + " objindec.val= " + objindec.val);

		// (console.log(obj));
	}
	addDiv() {
		//console.log(this.incdec);
        let objIncdec: IncDec = {
            val: 5
        }
        this.incdecarray.push(objIncdec);
	}
    newClicked(newObj: any, myObj: newTry) {

		if (newObj == '-') {
			myObj.val -= 1;
		} else if (newObj == '+') {
			myObj.val += 1;
		}
		// (console.log(obj));
	}
    newTryDiv() {
        console.log("test");
        let myObj: newTry = {
            val:0
        }
        this.newTryArray.push(myObj);
    }
}
