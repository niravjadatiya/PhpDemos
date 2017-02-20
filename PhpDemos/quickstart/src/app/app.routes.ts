import { Routes, RouterModule } from '@angular/router';
import { theMovieDbComponent } from './theMovieDb.component';
import { MoreInfo } from './MoreInfo.component';

export const routes: Routes = [
  { path: '', redirectTo: 'TheMovieDb', pathMatch: 'full' },
  { path: 'TheMovieDb', component: theMovieDbComponent },
  { path: 'MoreInfo/:id', component: MoreInfo }
];

export const appRoutingProviders: any[] = [

];

export const routing = RouterModule.forRoot(routes);