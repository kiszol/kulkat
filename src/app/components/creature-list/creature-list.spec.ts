import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatureList } from './creature-list';

describe('CreatureList', () => {
  let component: CreatureList;
  let fixture: ComponentFixture<CreatureList>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CreatureList]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreatureList);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
