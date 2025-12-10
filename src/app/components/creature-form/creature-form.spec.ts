import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CreatureForm } from './creature-form';

describe('CreatureForm', () => {
  let component: CreatureForm;
  let fixture: ComponentFixture<CreatureForm>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CreatureForm]
    })
    .compileComponents();

    fixture = TestBed.createComponent(CreatureForm);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
