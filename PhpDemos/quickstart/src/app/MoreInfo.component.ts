import { Component, OnInit, OnDestroy } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Http } from '@angular/http';
@Component({
  selector: 'MoreInfo',
  templateUrl:'app/MoreInfo.component.html',
  styleUrls:['app/MoreInfo.component.css']
})
export class MoreInfo implements OnInit, OnDestroy {
  id: number;
  private sub: any;
  moviesInfo: MovieIn[];
  constructor(private route: ActivatedRoute,private http:Http) {}
  link:string;
  photo:string ='http://image.tmdb.org/t/p/original';
  crew:string; 
  ngOnInit() {
    this.sub = this.route.params.subscribe(params => {
       this.id = +params['id']; // (+) converts string 'id' to a number

       // In a real app: dispatch action to load the details here.     
    });
    this.link = "http://api.themoviedb.org/3/movie/"+this.id+"?api_key=5de339ee88941d862165471adf9d5473&append_to_response=credits,releases,images"
    this.http.get(this.link)
    .subscribe(data => {
                this.moviesInfo = [data.json()];                            
            });
  }

  ngOnDestroy() {
    this.sub.unsubscribe();
  }
}

class MovieIn {
    poster_path: string;
    overview: string;
    release_date: string;
    id: number;
    original_language: number;
    title: string;
    popularity: string;
    vote_count: number;
    vote_average: number;
    genre_ids: any;
    images:any
    tagline:string;
    budget:number;
}