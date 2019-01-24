import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpErrorResponse } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { map, catchError, tap } from 'rxjs/operators';
@Injectable({
  providedIn: 'root'
})
export class RecordsService {

  constructor(private http: HttpClient) { }

   httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };

  private extractData(res: Response) {
    let body = res;
    return body || { };
  }

  getData(searchString, page): Observable<any> {
    // for now URL is static, which will be alter as per need
    return this.http.get('http://localhost/SearchEngine/BackEnd/web/google/search?p='+page+'&s='+searchString).pipe(
      map(this.extractData)
    );
  }

}
