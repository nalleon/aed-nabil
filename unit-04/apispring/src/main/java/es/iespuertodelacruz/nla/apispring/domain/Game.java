package es.iespuertodelacruz.nla.apispring.domain;

import es.iespuertodelacruz.nla.apispring.utils.Globals;

public class Game {
    private Integer hiddenNum;
    private Integer minNum;

    private Integer maxNum;



    private boolean isActive;

    private static Game instance;
    private Game() {
        isActive = false;
    }

    public static synchronized Game getInstance(){
        if (instance == null){
            instance = new Game();
        }
        return instance;
    }

    public synchronized boolean startRestartGame(){
        if (!isActive){
            hiddenNum = generateRnd(Globals.MAX_RND_NUM, Globals.MIN_RND_NUM);
            isActive = true;
            return true;
        } else {
            return false;
        }

    }

    private Integer generateRnd(int max, int min){
        return (int) (Math.random()*(max-min)+min);
    }

    public synchronized String placeBet(int numSelected){
        String message = null;

        if(!isActive){
            message = "Game is inactive. You can't bet at the moment";
        } else if (numSelected < Globals.MIN_RND_NUM || numSelected > Globals.MAX_RND_NUM) {
            message = "Num is not between min and max: " +  Globals.MIN_RND_NUM+ ", " + Globals.MAX_RND_NUM;
        } else if (numSelected == hiddenNum) {
            message = "Congratulations! You guessed the hidden num: " + hiddenNum;
            isActive = false;
        } else {
            if(hiddenNum < numSelected){
                message = "Hidden < " + numSelected;
            } else {
                message = "Hidden > " + numSelected;
            }
        }
        return message;
    }

    /**
     * Getters
     */
    public boolean isActive() {
        return isActive;
    }
}
