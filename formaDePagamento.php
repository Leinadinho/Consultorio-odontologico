<?php

class FormaDePagamento extends persist {

private string $TipoDePagamento;
private float $desconto;

public function __construct(string $TipoDePagamento,float $desconto) 

  public function setTipoDePagamento(float $TipoDePagamento)
  {
    $this->TipoDePagamento= $TipoDePagamento;
  }
  public function getTipoDePagamento()
  {
    return $this->TipoDePagamento;
  }
  public function setDesconto(float $desconto)
  {
    $this->desconto= $desconto;
  }
  public function getDesconto()
  {
    return $this->desconto;
  }