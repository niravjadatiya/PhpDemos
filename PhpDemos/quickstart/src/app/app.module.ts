import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpModule } from '@angular/http';
import { AppComponent }  from './app.component';
// import { IncDec } from './IncDec';
import { IncDecComponent } from './IncDec.component';
import { FormsModule }   from '@angular/forms';
import { CtoF } from './CtoF';
import { RouterModule, Routes } from '@angular/router';
import { theMovieDbComponent } from './theMovieDb.component';
import { MoreInfo } from './MoreInfo.component';
const appRoutes:Routes = [
  {
    path:'CelsiusToFahrenheit',
    component:CtoF,
    data:{title:'CelsiusToFahrenheit'}
  },
  {
    path:'IncrementDecrement',
    component:IncDecComponent
  },
  {
    path:'TheMovieDb',
    component:theMovieDbComponent
  },
  {
    path:'',
    redirectTo:'/',
    pathMatch:'full'
  },
  {
    path:'MoreInfo/:id',
    component:MoreInfo
  }
]


@NgModule({
  imports:      [ BrowserModule,FormsModule,HttpModule,RouterModule.forRoot(appRoutes)],
  declarations: [ AppComponent,CtoF,IncDecComponent,theMovieDbComponent,MoreInfo],
  bootstrap:    [ AppComponent]
})
export class AppModule { }
