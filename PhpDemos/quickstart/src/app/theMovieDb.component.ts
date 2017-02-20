import { Component, OnInit } from '@angular/core';
import { Http } from '@angular/http';
import {Router} from '@angular/router';



@Component({
    selector: 'TheMovieDb',
    templateUrl: 'app/theMovieDb.component.html',
    styleUrls: ['app/theMovieDbComponent.css']
})
export class theMovieDbComponent implements OnInit {
    genre_name: string = '';
    genre_ids: Array<any>;

    imgLink: string = 'https://image.tmdb.org/t/p/w185_and_h278_bestv2/';
    movieArray: Movie[];

    constructor(private http: Http,private router: Router) { }
    
    ngOnInit() {
        // this.loadData();
        this.http.get('http://api.themoviedb.org/3/movie/popular?api_key=5de339ee88941d862165471adf9d5473&page=1')
            
            .subscribe(data => {
                // console.log(data.json().results);
                this.movieArray = data.json().results;
                // console.log(this.movieArray);

            });
    }
    
    getGenreIds(genre: any) {

        this.genre_ids = [
            {   "id":28,
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
        var i: any, j: any, category: any;
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
    }
    pageNo = 1;
    loadMore() {
        this.pageNo++;
        this.http.get('http://api.themoviedb.org/3/movie/popular?api_key=5de339ee88941d862165471adf9d5473&page='+this.pageNo)
            .subscribe(data => {
                // console.log(data.json().results);
                
                var i:any;
                for(i = 0 ;i<data.json().results.length ;i++) {
                    this.movieArray.push(data.json().results[i]);
                }
                // console.log(data.json().results.length);
            });        
    }
    detailedView(mov:any) {
        console.log(mov.id);
        let link = ['/MoreInfo', mov.id];
        this.router.navigate(link);
        console.log(link);
        
        
    }
}
class GenreIds {


}
class Movie {
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

}
