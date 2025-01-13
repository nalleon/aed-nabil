package es.iespuertodelacruz.jc.acertarnumero.domain;

public class AcertarNumero {
	
	private static AcertarNumero acertarNumero;
	
	private AcertarNumero() {
		finalizada = true;
		secreto = null;
		minimo = null;
		maximo = null;
	}
	
	private Integer secreto;
	
	private Integer minimo;
	public Integer getMinimo() {
		return minimo;
	}

	public Integer getMaximo() {
		return maximo;
	}

	
	public String estatus() {
		String status = null;
		if(finalizada) {
			status = "la partida NO está iniciada. ";
			if( secreto != null) {
				status += "El último número secreto fue: " + secreto +". Los valores para apostar fueron entre: " + minimo + " y " + maximo;
			}
			
		}else {
			status = "la partida está activa. Los valores para apostar son entre: " + minimo + " y " + maximo;
		}
		return status;
	}
	private Integer maximo;
	
	private boolean finalizada;
	
	private int generarSecreto(int minimo, int maximo) {
		return (int)(Math.random()*(maximo-minimo + 1)+ minimo);
	}

	public boolean reiniciar(int minimo, int maximo) {
		if(finalizada ) {
			this.secreto = generarSecreto(minimo, maximo);
			this.finalizada = false;
			this.minimo = minimo;
			this.maximo = maximo;
			return true;
		}else		
			return false; 
	}
	
	
	public String apostar(int apuesta) {
		String respuesta = null;
		if( finalizada) {
			respuesta = " No se puede apostar hasta generar nuevo secreto. ";
		}else if( apuesta < minimo || apuesta > maximo){
			respuesta = " la apuesta no está entre los límites establecidos: " + minimo + ", " + maximo;
		}else if( apuesta == secreto) {
			respuesta = "acertaste! secreto era: " + secreto;
			finalizada = true;
		}else {
			respuesta = secreto > apuesta ? "secreto es mayor que ": "secreto es menor que ";
			respuesta += apuesta;
			
		}
		return respuesta;
	}
	
	public static AcertarNumero getInstance() {
		if(acertarNumero == null) {
			acertarNumero = new AcertarNumero();
		}
		return acertarNumero;
	}
}
