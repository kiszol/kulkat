import { Routes } from '@angular/router';
import { LoginComponent } from './components/login/login';
import { RegisterComponent } from './components/register/register';
import { CreatureListComponent } from './components/creature-list/creature-list';
import { CreatureFormComponent } from './components/creature-form/creature-form';
import { CreatureDetailComponent } from './components/creature-detail/creature-detail';
import { ContactComponent } from './components/contact/contact';

export const routes: Routes = [
  { path: '', redirectTo: '/creatures', pathMatch: 'full' },
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'creatures', component: CreatureListComponent },
  { path: 'creatures/new', component: CreatureFormComponent },
  { path: 'creatures/:id', component: CreatureDetailComponent },
  { path: 'creatures/:id/edit', component: CreatureFormComponent },
  { path: 'contact', component: ContactComponent },
];
