import { Component, OnInit } from '@angular/core';
import { RecordsService } from "../records.service"
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})

export class SearchComponent implements OnInit {
  sForm: FormGroup; // this will be Reactive form
  records: any
  totalRecords: number
  pages: number
  currentPages: number
  gotSearchResult:boolean
  searchString:string

  constructor(private dataProvider :RecordsService, private fb: FormBuilder){
    this.sForm = fb.group({
			'searchString': [null, Validators.required]
		});
    this.gotSearchResult= false
    this.records= {}
    this.totalRecords= 0
    this.pages= 0
    this.currentPages= 1
    this.searchString=""
  }

  ngOnInit(){}

  search(post){
		if(post.valid){
      this.searchString=post.value.searchString
      this.getSearchResult(this.searchString, 1)
    }
  }

  luckySearch(){
    this.getSearchResult('', 1)
  }

  hideList(){
    this.records = {};
    this.gotSearchResult = false;
    this.totalRecords=0
    this.pages = 0;
    this.currentPages=1
    this.searchString=""
  }

  getSearchResult(searchString, page){
    this.records = this.dataProvider.getData(searchString, page).subscribe((data) => {
      if(data){
        this.totalRecords = data.data.count;
        this.records = data.data.list;
        this.gotSearchResult = true;
        this.pages = Math.ceil(this.totalRecords/this.records.length);
        this.currentPages=page;
      }
    });
  }

  createArray(number){
    var items: number[] = [];
    for(var i = 1; i <= number; i++){
       items.push(i);
    }
    return items;
  }


}
