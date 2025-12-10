import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-login',
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class LoginComponent {
  email = '';
  password = '';
  errorMessage = '';
  isLoading = false;

  constructor(
    private authService: AuthService,
    private router: Router
  ) {}

  onLogin(): void {
    if (!this.email || !this.password) {
      this.errorMessage = 'Kérlek töltsd ki az összes mezőt!';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    console.log('Login megkezdése...', { email: this.email });

    this.authService.login(this.email, this.password).subscribe({
      next: (response) => {
        console.log('Sikeres bejelentkezés!', response);
        this.isLoading = false;
        alert(response.message);
        console.log('Navigálás a /creatures oldalra...');
        this.router.navigate(['/creatures']).then(success => {
          console.log('Navigáció eredménye:', success);
        });
      },
      error: (error) => {
        console.error('Bejelentkezési hiba:', error);
        this.isLoading = false;
        this.errorMessage = error.error?.message || 'Hibás email vagy jelszó!';
      }
    });
  }
}
