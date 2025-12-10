import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Kategoria {
  id: number;
  nev: string;
  leiras?: string;
}

export interface Kepesseg {
  id: number;
  nev: string;
  leiras?: string;
  tipus: string;
  pivot?: { szint: number };
}

export interface Leny {
  id: number;
  nev: string;
  leiras: string;
  eredet?: string;
  ritka_sag_szint: number;
  aktiv: boolean;
  kategoria_id: number;
  kategoria?: Kategoria;
  kepessegek?: Kepesseg[];
  galeria_kepek?: GaleriaKep[];
  user_id: number;
  created_at: string;
  updated_at: string;
}

export interface GaleriaKep {
  id: number;
  leny_id: number;
  kep_url: string;
  cim?: string;
  leiras?: string;
}

@Injectable({
  providedIn: 'root',
})
export class CreatureService {
  private readonly API_URL = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) {}

  // Lények
  getCreatures(): Observable<Leny[]> {
    return this.http.get<Leny[]>(`${this.API_URL}/creatures`);
  }

  getCreature(id: number): Observable<Leny> {
    return this.http.get<Leny>(`${this.API_URL}/creatures/${id}`);
  }

  createCreature(data: Partial<Leny>): Observable<any> {
    return this.http.post(`${this.API_URL}/creatures`, data);
  }

  updateCreature(id: number, data: Partial<Leny>): Observable<any> {
    return this.http.put(`${this.API_URL}/creatures/${id}`, data);
  }

  deleteCreature(id: number): Observable<any> {
    return this.http.delete(`${this.API_URL}/creatures/${id}`);
  }

  // Képességek hozzáadása/eltávolítása
  attachAbility(lenyId: number, kepessegId: number, szint: number): Observable<any> {
    return this.http.post(`${this.API_URL}/creatures/${lenyId}/abilities`, {
      kepesseg_id: kepessegId,
      szint
    });
  }

  detachAbility(lenyId: number, kepessegId: number): Observable<any> {
    return this.http.delete(`${this.API_URL}/creatures/${lenyId}/abilities/${kepessegId}`);
  }

  // Kategóriák
  getKategoriak(): Observable<Kategoria[]> {
    return this.http.get<Kategoria[]>(`${this.API_URL}/kategoriak`);
  }

  // Képességek
  getKepessegek(): Observable<Kepesseg[]> {
    return this.http.get<Kepesseg[]>(`${this.API_URL}/kepessegek`);
  }

  // Galéria
  getGallery(lenyId: number): Observable<GaleriaKep[]> {
    return this.http.get<GaleriaKep[]>(`${this.API_URL}/creatures/${lenyId}/gallery`);
  }

  uploadImage(lenyId: number, formData: FormData): Observable<any> {
    return this.http.post(`${this.API_URL}/creatures/${lenyId}/gallery`, formData);
  }

  deleteImage(lenyId: number, kepId: number): Observable<any> {
    return this.http.delete(`${this.API_URL}/creatures/${lenyId}/gallery/${kepId}`);
  }

  // Kapcsolat
  sendContact(data: any): Observable<any> {
    return this.http.post(`${this.API_URL}/contact`, data);
  }
}
