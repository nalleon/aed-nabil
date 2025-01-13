package es.iespuertodelacruz.jc.acertarnumero.controller;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import es.iespuertodelacruz.jc.acertarnumero.domain.AcertarNumero;
import es.iespuertodelacruz.jc.acertarnumero.utils.Globals;

/*
class ApuestaDTO{
	int apuesta;
	public int getApuesta() {
		return apuesta;
	}
	public void setApuesta(int apuesta) {
		this.apuesta = apuesta;
	}
	public ApuestaDTO() {}
	
}
*/
record ApuestaDTO(int apuesta) {}



@RestController
@RequestMapping("/api/acertarnumero")
@CrossOrigin
public class AcertarNumeroRESTController {

	@PostMapping("/apuestas")
	public ResponseEntity<?> apostar(@RequestBody ApuestaDTO apuestaDTO){
		AcertarNumero acertarNumero = AcertarNumero.getInstance();
		String apostar = acertarNumero.apostar(
				//apuestaDTO.getApuesta()
				apuestaDTO.apuesta()
		);
		return ResponseEntity.ok(apostar);
	}
	
	
	@GetMapping
	public ResponseEntity<?> estatusPartida(){
		AcertarNumero acertarNumero = AcertarNumero.getInstance();
		
		return ResponseEntity.ok(acertarNumero.estatus());
	}
	
	@PostMapping
	public ResponseEntity<?> iniciarReiniciarPartida(){
		AcertarNumero acertarNumero = AcertarNumero.getInstance();
		boolean reiniciar = acertarNumero.reiniciar(Globals.MINIMO, Globals.MAXIMO);
		String mensaje = reiniciar ? 
				" ok partida iniciada con nuevo secreto entre: " + Globals.MINIMO + " y " + Globals.MAXIMO 
				: 
				" partida activa. Para reiniciar hay primero que acertar la partida actual con apuesta correcta ";
		return ResponseEntity.ok(mensaje);
	}
}
