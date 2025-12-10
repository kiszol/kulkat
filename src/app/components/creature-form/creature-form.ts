import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { CreatureService, Kategoria, Leny } from '../../services/creature';

@Component({
  selector: 'app-creature-form',
  imports: [CommonModule, FormsModule, RouterModule],
  templateUrl: './creature-form.html',
  styleUrl: './creature-form.css',
})
export class CreatureFormComponent implements OnInit {
  creature: Partial<Leny> = {
    nev: '',
    leiras: '',
    eredet: '',
    ritka_sag_szint: 5,
    kategoria_id: 0
  };
  kategoriak: Kategoria[] = [];
  isEditMode = false;
  isLoading = false;
  creatureId: number | null = null;

  constructor(
    private creatureService: CreatureService,
    private router: Router,
    private route: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.loadKategoriak();
    
    // Ellenőrizzük, hogy szerkesztési módban vagyunk-e
    this.route.params.subscribe(params => {
      if (params['id']) {
        this.isEditMode = true;
        this.creatureId = +params['id'];
        this.loadCreature(this.creatureId);
      }
    });
  }

  loadKategoriak(): void {
    this.creatureService.getKategoriak().subscribe({
      next: (data) => {
        this.kategoriak = data;
        if (data.length > 0 && !this.creature.kategoria_id) {
          this.creature.kategoria_id = data[0].id;
        }
      },
      error: (error) => console.error('Hiba a kategóriák betöltésekor:', error)
    });
  }

  loadCreature(id: number): void {
    this.creatureService.getCreature(id).subscribe({
      next: (data) => {
        this.creature = data;
      },
      error: (error) => {
        console.error('Hiba a lény betöltésekor:', error);
        this.router.navigate(['/creatures']);
      }
    });
  }

  onSubmit(): void {
    if (!this.creature.nev || !this.creature.leiras || !this.creature.kategoria_id) {
      alert('Kérlek töltsd ki az összes kötelező mezőt!');
      return;
    }

    this.isLoading = true;

    const operation = this.isEditMode && this.creatureId
      ? this.creatureService.updateCreature(this.creatureId, this.creature)
      : this.creatureService.createCreature(this.creature);

    operation.subscribe({
      next: (response) => {
        this.isLoading = false;
        alert(response.message || 'Sikeres művelet!');
        this.router.navigate(['/creatures']);
      },
      error: (error) => {
        this.isLoading = false;
        alert('Hiba történt: ' + (error.error?.message || 'Ismeretlen hiba'));
      }
    });
  }
}
