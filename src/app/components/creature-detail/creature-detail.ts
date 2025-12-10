import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, RouterModule } from '@angular/router';
import { CreatureService, Leny } from '../../services/creature';

@Component({
  selector: 'app-creature-detail',
  imports: [CommonModule, RouterModule],
  templateUrl: './creature-detail.html',
  styleUrl: './creature-detail.css',
})
export class CreatureDetailComponent implements OnInit {
  creature: Leny | null = null;
  isLoading = true;

  constructor(
    private route: ActivatedRoute,
    private creatureService: CreatureService
  ) {}

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      const id = +params['id'];
      this.loadCreature(id);
    });
  }

  loadCreature(id: number): void {
    this.isLoading = true;
    this.creatureService.getCreature(id).subscribe({
      next: (data) => {
        this.creature = data;
        this.isLoading = false;
      },
      error: (error) => {
        console.error('Hiba:', error);
        this.isLoading = false;
      }
    });
  }
}
