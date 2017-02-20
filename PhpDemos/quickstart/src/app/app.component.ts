import { Component } from '@angular/core';
import { Http } from '@angular/http';
import { CtoF } from './CtoF';
import { IncDecComponent } from './IncDec.component';

@Component({
  selector: 'my-app',
  template: `      
      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <a class="navbar-brand" routerLink="/">Home</a>
        </div>

        <ul class="nav navbar-nav">        
          <li [routerLinkActive]="['active']" ><a routerLink="/CelsiusToFahrenheit">Celsius To Fahrenheit</a></li>
          <li [routerLinkActive]="['active']" ><a routerLink="/IncrementDecrement">Increment Decrement</a></li>
          <li [routerLinkActive]="['active']" ><a routerLink="/TheMovieDb">The MovieDB</a></li>
        </ul>
        
      </nav>      
      <router-outlet></router-outlet>
        `,
})
export class AppComponent {
  name = 'Welocome to Logistic Infotech';


}
