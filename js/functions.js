//função para validar o cartão de cidadão português
function validarCC(number) {
    let letter_value = { A: 10, B: 11, C: 12, D: 13, E: 14, F: 15, G: 16, H: 17, I: 18, J: 19, K: 20, L: 21, M: 22, N: 23, O: 24, P: 25, Q: 26, R: 27, S: 28, T: 29, U: 30, V: 31, W: 32, X: 33, Y: 34, Z: 35 };
      let cc_number = number.replace(/-|\s/g, ''); // remove space and -
      cc_number = cc_number.toUpperCase();
      cc_number = [...cc_number];
      cc_number = cc_number.reverse();
      cc_number[1] = letter_value[cc_number[1]];
      cc_number[2] = letter_value[cc_number[2]];
      let sum = 0;
      let dum = 0;
      jQuery.each(cc_number, function (k, v) {
        if (k % 2 == 0) {
          dum = parseInt(v);
        }
        else {
          dum = parseInt(v) * 2;
          if (dum >= 10)
            dum -= 9;
        }
        sum += dum;
        console.log('k : ' + k + ' | sum : ' + sum);
      });

      return (sum % 10 == 0) ? true : false;
  } 
 //validar NIF
  function validarNIF(contribuinte) {
    var erro = 0;
    if (
      contribuinte.substr(0, 1) != '1' && // pessoa singular
      contribuinte.substr(0, 1) != '2' && // pessoa singular
      contribuinte.substr(0, 1) != '3' && // pessoa singular
      contribuinte.substr(0, 2) != '45' && // pessoa singular não residente
      contribuinte.substr(0, 1) != '5' && // pessoa colectiva
      contribuinte.substr(0, 1) != '6' && // administração pública
      contribuinte.substr(0, 2) != '70' && // herança indivisa
      contribuinte.substr(0, 2) != '71' && // pessoa colectiva não residente
      contribuinte.substr(0, 2) != '72' && // fundos de investimento
      contribuinte.substr(0, 2) != '77' && // atribuição oficiosa
      contribuinte.substr(0, 2) != '79' && // regime excepcional
      contribuinte.substr(0, 1) != '8' && // empresário em nome individual (extinto)
      contribuinte.substr(0, 2) != '90' && // condominios e sociedades irregulares
      contribuinte.substr(0, 2) != '91' && // condominios e sociedades irregulares
      contribuinte.substr(0, 2) != '98' && // não residentes
      contribuinte.substr(0, 2) != '99' // sociedades civis

    ) { erro = 1; }
    var verf1 = contribuinte.substr(0, 1) * 9;
    var verf2 = contribuinte.substr(1, 1) * 8;
    var verf3 = contribuinte.substr(2, 1) * 7;
    var verf4 = contribuinte.substr(3, 1) * 6;
    var verf5 = contribuinte.substr(4, 1) * 5;
    var verf6 = contribuinte.substr(5, 1) * 4;
    var verf7 = contribuinte.substr(6, 1) * 3;
    var verf8 = contribuinte.substr(7, 1) * 2;

    var total = verf1 + verf2 + verf3 + verf4 + verf5 + verf6 + verf7 + verf8;
    var divisao = total / 11;
    var modulo11 = total - parseInt(divisao) * 11;
    if (modulo11 == 1 || modulo11 == 0) { comparador = 0; } // excepção
    else { comparador = 11 - modulo11; }


    var ultimoDigito = contribuinte.substr(8, 1) * 1;
    if (ultimoDigito != comparador) { erro = 1; }

    if (erro == 1) { return false; }else { return true; }

  }
  //Função para validar numero de identificação da segurança social
  function validarNISS(niss) {
    
    //deve ter 11 dígitos
    if(niss.length != 11) {
       return false;
    } else {
        var FACTORS = [29, 23, 19, 17, 13, 11, 7, 5, 3, 2];
        var nissArray = [];
        for (var i = 0; i < niss.length; i++) {
            nissArray[i] = niss.charAt(i);
        }

        var sum=0;

        //faz a soma do digito [j] x o dígito [j] do array dos fatores
        for (var j = 0; j < FACTORS.length; j++) {
            sum += nissArray[j] * FACTORS[j];
        }

        //verifica se dá resto 0
        if (nissArray[nissArray.length - 1] == (9 - (sum % 10))) {
            return true;
        } else {
           return false;
        }
    }
  }

