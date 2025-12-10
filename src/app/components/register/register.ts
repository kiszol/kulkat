import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Router, RouterModule } from '@angular/router';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-register',
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './register.html',
  styleUrl: './register.css',
})
export class RegisterComponent {
  name = '';
  email = '';
  password = '';
  password_confirmation = '';
  errorMessage = '';
  isLoading = false;

  constructor(
    private authService: AuthService,
    private router: Router
  ) {}

  onRegister(): void {
    if (!this.name || !this.email || !this.password || !this.password_confirmation) {
      this.errorMessage = 'Kérlek töltsd ki az összes mezőt!';
      return;
    }

    if (this.password !== this.password_confirmation) {
      this.errorMessage = 'A két jelszó nem egyezik!';
      return;
    }

    if (this.password.length < 8) {
      this.errorMessage = 'A jelszónak legalább 8 karakter hosszúnak kell lennie!';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    console.log('Regisztráció megkezdése...', { name: this.name, email: this.email });

    this.authService.register(this.name, this.email, this.password, this.password_confirmation).subscribe({
      next: (response) => {
        console.log('Sikeres regisztráció!', response);
        this.isLoading = false;
        alert(response.message);
        console.log('Navigálás a /creatures oldalra...');
        this.router.navigate(['/creatures']).then(success => {
          console.log('Navigáció eredménye:', success);
        });
      },
      error: (error) => {
        console.error('Regisztrációs hiba:', error);
        this.isLoading = false;
        if (error.error?.errors) {
          const errors = Object.values(error.error.errors).flat();
          this.errorMessage = errors.join(' ');
        } else {
          this.errorMessage = error.error?.message || 'Hiba történt a regisztráció során!';
        }
      }
    });
  }
}
