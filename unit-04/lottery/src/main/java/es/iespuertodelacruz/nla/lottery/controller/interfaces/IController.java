package es.iespuertodelacruz.nla.lottery.controller.interfaces;

import es.iespuertodelacruz.nla.lottery.dto.BetDTO;
import es.iespuertodelacruz.nla.lottery.dto.RaffleDTO;
import org.springframework.http.ResponseEntity;

import java.util.List;

public interface IController {
    public ResponseEntity add(int id, BetDTO betDTO);
    public ResponseEntity<List<RaffleDTO>> getAll();
    public ResponseEntity<RaffleDTO> getById(int id);

    public ResponseEntity getLatest();

}
