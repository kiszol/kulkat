import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { CreatureService } from '../../services/creature';

@Component({
  selector: 'app-contact',
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './contact.html',
  styleUrl: './contact.css',
})
export class ContactComponent {
  contactData = {
    nev: '',
    email: '',
    targy: '',
    uzenet: ''
  };
  isLoading = false;
  successMessage = '';
  errorMessage = '';

  constructor(private creatureService: CreatureService) {}

  onSubmit(): void {
    if (!this.contactData.nev || !this.contactData.email || 
        !this.contactData.targy || !this.contactData.uzenet) {
      this.errorMessage = 'Kérlek töltsd ki az összes mezőt!';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';
    this.successMessage = '';

    this.creatureService.sendContact(this.contactData).subscribe({
      next: (response) => {
        this.isLoading = false;
        this.successMessage = response.message || 'Üzenet sikeresen elküldve!';
        // Reset form
        this.contactData = { nev: '', email: '', targy: '', uzenet: '' };
      },
      error: (error) => {
        this.isLoading = false;
        this.errorMessage = error.error?.message || 'Hiba történt az üzenet küldésekor!';
      }
    });
  }
}
