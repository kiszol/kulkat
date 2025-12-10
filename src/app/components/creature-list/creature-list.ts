import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Router, RouterModule } from '@angular/router';
import { CreatureService, Leny } from '../../services/creature';
import { AuthService } from '../../services/auth';

@Component({
  selector: 'app-creature-list',
  imports: [CommonModule, RouterModule],
  templateUrl: './creature-list.html',
  styleUrl: './creature-list.css',
})
export class CreatureListComponent implements OnInit {
  creatures: Leny[] = [];
  isLoading = true;
  isAuthenticated = false;

  constructor(
    private creatureService: CreatureService,
    private authService: AuthService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.isAuthenticated = this.authService.isAuthenticated();
    this.loadCreatures();
  }

  loadCreatures(): void {
    this.isLoading = true;
    this.creatureService.getCreatures().subscribe({
      next: (data) => {
        this.creatures = data;
        this.isLoading = false;
      },
      error: (error) => {
        console.error('Hiba a lények betöltésekor:', error);
        this.isLoading = false;
      }
    });
  }

  deleteCreature(id: number, event: Event): void {
    event.stopPropagation();
    if (confirm('Biztosan törölni szeretnéd ezt a lényt?')) {
      this.creatureService.deleteCreature(id).subscribe({
        next: () => {
          alert('Lény sikeresen törölve!');
          this.loadCreatures();
        },
        error: (error) => {
          alert('Hiba történt: ' + (error.error?.message || 'Ismeretlen hiba'));
        }
      });
    }
  }

  viewDetails(id: number): void {
    this.router.navigate(['/creatures', id]);
  }

  logout(): void {
    if (confirm('Biztosan ki szeretnél jelentkezni?')) {
      this.authService.logout().subscribe({
        next: () => {
          alert('Sikeresen kijelentkeztél!');
          this.isAuthenticated = false;
          this.router.navigate(['/login']);
        },
        error: (error) => {
          console.error('Kijelentkezési hiba:', error);
          // Akkor is kijelentkeztetjük helyben
          this.authService['clearToken']();
          this.isAuthenticated = false;
          this.router.navigate(['/login']);
        }
      });
    }
  }
}
